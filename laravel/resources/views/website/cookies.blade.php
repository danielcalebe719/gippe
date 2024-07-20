<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies | Buffet Divino Sabor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <style>
       

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
            color: #333;
        }

        .cookie-section {
            background-color: white;    
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }

        .cookie-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .cookie-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-primary:hover {
            background-color: #FF8C61;
            border-color: #FF8C61;
        }

        h1 {
            font-size: 2.5rem;
            color: var(--bs-primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 2rem;
            color: var(--bs-secondary);
            font-weight: 600;
            margin-bottom: 1.25rem;
        }

        h3 {
            font-size: 1.5rem;
            color: var(--bs-info);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .lead {
            font-size: 1.1rem;
            font-weight: 400;
        }
        
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica se as preferências de cookies estão salvas no armazenamento local
            const cookiePreferences = localStorage.getItem('cookiePreferences');

            if (cookiePreferences) {
                const preferences = JSON.parse(cookiePreferences);
                document.getElementById('functionalCookies').checked = preferences.functional;
                document.getElementById('analyticalCookies').checked = preferences.analytical;
                document.getElementById('advertisingCookies').checked = preferences.advertising;
            }

            // Salva as preferências quando o botão 'Salvar Preferências' é clicado
            document.getElementById('savePreferences').addEventListener('click', function() {
                const preferences = {
                    functional: document.getElementById('functionalCookies').checked,
                    analytical: document.getElementById('analyticalCookies').checked,
                    advertising: document.getElementById('advertisingCookies').checked
                };
                localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
                alert('Preferências de cookies salvas.');

                // Fecha o modal após salvar as preferências
                const cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieModal'));
                cookieModal.hide();
            });
        });
    </script>
</head>

<body>
@include('partials.navbar')
    <main class="container my-5">
        <h1 class="text-center mb-5" style="color: #FF6B35;">Política de Cookies</h1>

        <section class="cookie-section p-5 mb-5">
            <h2>Introdução</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim.</p>
        </section>

        <section class="cookie-section p-5 mb-5">
            <h2>O que são cookies?</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim.</p>
        </section>

        <section class="cookie-section p-5 mb-5">
            <h2>Tipos de Cookies que Utilizamos</h2>

            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <div class="cookie-icon bg-success">E</div>
                </div>
                <div class="col">
                    <h3 style="color: black;">Cookies Essenciais</h3>
                    <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <div class="cookie-icon bg-info">F</div>
                </div>
                <div class="col">
                    <h3 style="color: black;">Cookies Funcionais</h3>
                    <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <div class="cookie-icon bg-warning">A</div>
                </div>
                <div class="col">
                    <h3 style="color: black;">Cookies Analíticos</h3>
                    <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="cookie-icon bg-danger">P</div>
                </div>
                <div class="col">
                    <h3 style="color: black;">Cookies de Publicidade</h3>
                    <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
                </div>
            </div>
        </section>

        <section class="cookie-section p-5 mb-5">
            <h2>Gerenciando suas Preferências de Cookies</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
            <button class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#cookieModal" style="background-color: #FF6B35;">Ajustar Preferências de Cookies</button>
        </section>

        <section class="cookie-section p-5 mb-5">
            <h2>Atualizações da Política de Cookies</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
        </section>
    </main>

    <!-- Modal de Preferências de Cookies -->
    <div class="modal fade" id="cookieModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preferências de Cookies</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cookiePreferencesForm">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="functionalCookies">
                                <label class="form-check-label" for="functionalCookies">
                                    Cookies Funcionais
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="analyticalCookies">
                                <label class="form-check-label" for="analyticalCookies">
                                    Cookies Analíticos
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="advertisingCookies">
                                <label class="form-check-label" for="advertisingCookies">
                                    Cookies de Publicidade
                                </label>
                            </div>
                        </div>
                        <button type="button" id="savePreferences" class="btn btn-primary" style="background-color: #FF6B35;">Salvar Preferências</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>
</body>
</html>
