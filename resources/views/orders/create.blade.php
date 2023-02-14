@extends('layouts.default')

@section('content')
    <div class="col">

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Cadastrar nova venda</span>
                    <a class="" href="{{ route('orders.index') }}" role="button">Voltar a listagem</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="client">Cliente</label>
                        <input type="text" class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }}"
                            name="client" id="client" value="{{ old('client') }}" placeholder="Ex. João Silva...">
                        @if ($errors->has('client'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('client') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            name="description" id="description" value="{{ old('description') }}"
                            placeholder="Ex. Pedido recebido por email...">
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Orçamento" {{ old('status') === 'Orçamento' ? 'selected' : null }}>Orçamento
                            </option>
                            <option value="Venda" {{ old('status') === 'Venda' ? 'selected' : null }}>Venda</option>
                        </select>
                    </div>
                    <fieldset class="form-group border p-2" id="addProductToOrder">
                        <legend for="addProductToOrder" class="w-auto px-2 h5">Adicionar produto a venda</legend>
                        <div class="row">
                            <div class="col-2">
                                <label for="quantitySelector">Quantidade</label>
                                <input type="tel" step="1" class="form-control text-center" value="1"
                                    id="quantitySelector" onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                    min="0">
                            </div>

                            <div class="col-5">
                                <label for="productSelector">Produto</label>
                                <select class="form-control" id="productSelector" onChange="setInitialPrice()">
                                    <option value="" disabled selected>Selecione</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" defaultPrice="{{ $product->getPrice() }}">
                                            {{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="priceSelector">Valor Unitário</label>
                                <input type="number" step="0.01" class="form-control text-center" id="priceSelector"
                                    min="0">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-block"
                                    onClick="clearAddProduct()">Limpar</button>
                                <button type="button" class="btn btn-outline-primary btn-sm btn-block"
                                    onClick="addProductOrder()">Adicionar</button>
                            </div>
                        </div>
                    </fieldset>
                    <table class="table table-borderless table-striped">
                        <thead class="border">
                            <th class="col-1 text-center">Quantidade</th>
                            <th class="col-6">Produto</th>
                            <th class="col-2 text-center">Valor Unitário</th>
                            <th class="col-2 text-center">Valor Total</th>
                            <th class="col-1"></th>
                        </thead>
                        <tbody id="productsTable" class="border">
                        </tbody>

                    </table>
                    @if ($errors->has('product_id'))
                        <div class="alert alert-danger" role="alert">
                            Você deve adicionar pelo menos um produto ao pedido.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <label for="subTotal">Sub-Total</label>
                            <input type="number" class="form-control" onload="refreshSubTotal()" id="subTotal" disabled>
                        </div>
                        <div class="col-4">
                            <label for="discount">Desconto</label>
                            <input type="number" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}"
                                name="discount" id="discount" value="{{ old('discount') ?? 0 }}" step="0.01"
                                min="0" onChange="refreshTotal()">
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-4">
                            <label for="addition">Acréscimo</label>
                            <input type="number" class="form-control{{ $errors->has('addition') ? ' is-invalid' : '' }}"
                                name="addition" id="addition" value="{{ old('addition') ?? 0 }}" step="0.01"
                                min="0" onChange="refreshTotal()">
                            @if ($errors->has('addition'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('addition') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 align-items-baseline">
                        <p class="mr-2">Valor total do pedido:</p>
                        <p class="h4">R$ <span id="totalOrder" onload="refreshTotal()">0,00</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-end mt-4"><button type="reset"
                            class="btn btn-secondary mr-2">Limpar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function setInitialPrice() {
            const productSelector = document.getElementById('productSelector');
            const priceSelector = document.getElementById('priceSelector');
            const priceUnit = productSelector.options[productSelector.selectedIndex].getAttribute('defaultPrice');
            priceSelector.value = priceUnit;
        }

        function clearAddProduct() {
            const productSelector = document.getElementById('productSelector');
            const priceSelector = document.getElementById('priceSelector');
            const quantitySelector = document.getElementById('quantitySelector');
            productSelector.value = "";
            quantitySelector.value = 1;
            priceSelector.value = "";
        }

        function addProductOrder() {
            const productSelector = document.getElementById('productSelector');
            const priceSelector = document.getElementById('priceSelector');
            const quantitySelector = document.getElementById('quantitySelector');
            const productsTable = document.getElementById('productsTable');
            const randomId = getRandomId();
            if (!productSelector.value || !priceSelector.value || !quantitySelector) return;
            const newTr = document.createElement('tr');
            newTr.id = randomId;
            newTr.innerHTML = `<input type="hidden" value="${productSelector.value}" name="product_id[]">
                                <td><input type="text" step="1" class="form-control text-center" value="${quantitySelector.value}"
                                        name="product_quantity[]" id="${randomId}_productQuantity" min="0" onChange="updateProductTotal(${randomId})"
                                        onkeypress="return event.charCode >= 48 && event.charCode <=57" required></td>
                                <td><input type="text" class="form-control" name="product_title[]" value="${productSelector.options[productSelector.selectedIndex].text}"></td>
                                <td><input type="number" step="0.01" class="form-control text-center" value="${priceSelector.value}"
                                        name="product_price[]" id="${randomId}_productPrice" onChange="updateProductTotal(${randomId})" min="0" required></td>
                                <td><input type="text" class="form-control text-center totalCounter" value="${Math.round(priceSelector.value * quantitySelector.value * 100) / 100}"
                                        disabled id="${randomId}_productTotal">
                                </td>
                                <td class="align-middle"><a href="#" onClick="removeProduct(${randomId})"
                                        class="text-danger">Apagar</a></td>`;
            productsTable.appendChild(newTr);
            clearAddProduct();
            refreshSubTotal()
        }

        function getRandomId() {
            return Math.round(Date.now() * Math.random());
        }

        function removeProduct(id) {
            const productsTable = document.getElementById('productsTable');
            const getTr = document.getElementById(id);
            getTr.remove();
            refreshSubTotal()
        }

        function updateProductTotal(id) {
            const productTotalInput = document.getElementById(`${id}_productTotal`);
            const productQuantityInput = document.getElementById(`${id}_productQuantity`);
            const productPriceInput = document.getElementById(`${id}_productPrice`);
            productTotalInput.value = Math.round(productPriceInput.value * productQuantityInput.value * 100) / 100;
            refreshSubTotal()
        }

        function getSubTotal() {
            const subProductsInput = document.querySelectorAll("input.totalCounter");
            let subtotal = [...subProductsInput].reduce((acc, actual) => Number(actual.value) + acc, 0);
            return subtotal;
        }

        function refreshSubTotal() {
            const subTotalInput = document.getElementById('subTotal');
            subTotalInput.value = getSubTotal();
            refreshTotal();
        }

        function refreshTotal() {
            const subTotalInput = document.getElementById('subTotal');
            const discountInput = document.getElementById('discount');
            const additionInput = document.getElementById('addition');
            const totalOrderText = document.getElementById('totalOrder');
            totalOrderText.innerText = Math.round((Number(subTotalInput.value) - Number(discountInput.value) + Number(
                additionInput.value)) * 100) / 100;
        }
    </script>
@endsection
