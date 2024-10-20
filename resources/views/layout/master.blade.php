<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body>
    <main>
        @include('layout.topbar')
        <div class="container main-content">
            <div class="row  py-5">
                @yield('content')
            </div>
        </div>
    </main>
    @include('layout.bottombar')
</body>

</html>
