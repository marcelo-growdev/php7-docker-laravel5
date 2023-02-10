<div class="card mx-auto" style="max-width: 18rem;">
    <ul class="list-group list-group-flush">
        @component('components.navMenuItem', ['route' => 'home'])
            Home
        @endcomponent
        @component('components.navMenuItem', ['route' => 'products.index'])
            Produtos
        @endcomponent
        @component('components.navMenuItem', ['route' => 'categories.index'])
            Categorias
        @endcomponent
    </ul>
</div>
