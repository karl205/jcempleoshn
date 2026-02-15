import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay } from "swiper/modules";

import "swiper/css";

export default function Testimonials() {
  const comentarios = [
    { txt: "Encontré empleo rápidamente.", name: "María Gómez", role: "Diseñadora" },
    { txt: "Muy fácil de usar.", name: "Carlos Pérez", role: "Soporte TI" },
    { txt: "Postulé desde el celular.", name: "Lucía Torres", role: "Administrativa" },
    { txt: "Excelente plataforma.", name: "Juan Ramírez", role: "Contador" },
    { txt: "Recomendada al 100%.", name: "Ana Martínez", role: "Programadora" },
  ];

  return (
    <section className="testimonials-section">
      <div className="container">
        <h3 className="text-center fw-bold mb-4">
          Comentarios de nuestros usuarios
        </h3>

        <Swiper
          modules={[Autoplay]}
          spaceBetween={24}
          slidesPerView={1}
          breakpoints={{
            576: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
          }}
          loop={true}
          autoplay={{
            delay: 2000,
            disableOnInteraction: false,
          }}
        >
          {comentarios.map((c, index) => (
            <SwiperSlide key={index}>
              <div className="comment-card p-4 shadow-sm rounded bg-white">
                <p className="mb-3">“{c.txt}”</p>

                <div className="d-flex align-items-center gap-3">
                  <div className="avatar">
                    👤
                  </div>
                  <div>
                    <strong>{c.name}</strong><br />
                    <span className="small text-muted">{c.role}</span>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  );
}
