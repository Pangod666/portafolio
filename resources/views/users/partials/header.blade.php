<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(https://img.freepik.com/vector-gratis/antecedentes-medicos-limpios_53876-97927.jpg?w=2000); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-4"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 class="display-2 text-white">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-5">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div> 