<section id="about" class="about section">

    <div class="container">

        <div class="row gy-4 gx-5">

            <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('vendor/medilab/assets/img/about.jpg') }}" class="img-fluid" alt="Consultorio Dra. Yorlenis">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>

            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h3>Sobre la Dra. Yorlenis Uzcátegui</h3>
                <p>
                    Atención ginecológica especializada con enfoque humano, profesional y actualizado. La Dra. Yorlenis Uzcátegui acompaña a cada paciente en las distintas etapas de su salud femenina, ofreciendo diagnóstico, prevención y tratamiento con calidez y precisión.
                </p>
                <ul>
                    <li>
                        <i class="fa-solid fa-vial-circle-check"></i>
                        <div>
                            <h5>Planificación familiar y control prenatal</h5>
                            <p>Seguimiento personalizado durante el embarazo, asesoría en métodos anticonceptivos y preparación para el parto.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-pump-medical"></i>
                        <div>
                            <h5>Estudios especializados y cirugía ginecológica</h5>
                            <p>Ecografía Doppler, biopsias, histeroscopia, atención quirúrgica y procedimientos mínimamente invasivos.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-heart-circle-xmark"></i>
                        <div>
                            <h5>Menopausia y bienestar integral</h5>
                            <p>Tratamientos para síntomas hormonales, prevención de osteoporosis y acompañamiento emocional en esta etapa.</p>
                        </div>
                    </li>
                </ul>
                @guest
                    <div x-data class="mt-5 text-center d-md-none">
                        <a href="#" @click.prevent="mostrarAlertAuth()" class="btn btn-primary px-4 py-2 rounded-pill">
                            Agendar cita
                        </a>
                    </div>
                @endguest

            </div>

        </div>

    </div>

</section>
