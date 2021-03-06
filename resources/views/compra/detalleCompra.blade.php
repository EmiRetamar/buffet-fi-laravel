@extends('layout')

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/altaProducto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/listadoProductos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paginador.css') }}">

@endsection

@section('nav')

    @include('parts/compra_nav')

@endsection

@section('content')

    <section class="principal">
        <h2>Productos de la compra</h2>
        <table id="listado" class="listado">
            <tr class="categorias">
                <th class="title">Nombre</th>
                <th class="title">Marca</th>
                <th class="title">Codigo de barra</th>
                <th class="title">Stock</th>
                <th class="title">Stock minimo</th>
                <th class="title">Proveedor</th>
                <th class="title">Precio unitario</th>
                <th class="title">Descripcion</th>
                <th class="title">Cantidad</th>
                <th class="title">Categoria</th>
            </tr>
            @foreach($compra_detalle as $producto)
                <tr>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->codigo_barra }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->stock_minimo }}</td>
                    <td>{{ $producto->proveedor }}</td>
                    <td>{{ $producto->precio_venta_unitario }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->nombre_categoria }}</td>
                </tr>
            @endforeach
        </table>
        <div id="black" class="margen">
        </div>

        <br>
        <br>

        <h2>Factura de la compra</h2>

        <br>

        <img src="{{ asset('uploads/' . $compra_detalle[0]->nombreFactura) }}" title="Factura de la compra" alt="Factura de la compra" height="250"  width="250">
    </section>

@endsection

@section('javascript')

    <!-- Configuracion de la paginacion -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#black').smartpaginator({ totalrecords: {{ count($compra_detalle) }}, recordsperpage: {{ $config->elementos }}, datacontainer: 'listado', dataelement: 'tr', length: 1, initval: 0, next: 'Siguiente', prev: 'Anterior', first: 'Primero', last: 'Último', theme: 'black', controlsalways: true });
        });
    </script>

@endsection