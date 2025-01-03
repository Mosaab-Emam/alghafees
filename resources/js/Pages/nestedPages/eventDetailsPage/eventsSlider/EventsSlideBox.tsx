import React from "react";
// Import Swiper React components
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, FreeMode, Pagination } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";

import { Swiper as SwiperType } from "swiper/types";
import { ourEventsData } from "../../../../data/ourEventsData";
import SlideBox from "./SlideBox";

const EventsSlideBox = ({
    swiperRef,
}: {
    swiperRef: React.RefObject<SwiperType>;
}) => {
    return (
        <section className="our-clients-swiper w-full  ">
            <Swiper
                onBeforeInit={(swiper) => {
                    swiperRef.current = swiper;
                }}
                pagination={{
                    clickable: true,
                    el: ".custom-pagination",
                }}
                autoplay={{
                    delay: 2000,
                    disableOnInteraction: false,
                }}
                breakpoints={{
                    320: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 1.5,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 3.2,
                        spaceBetween: 20,
                    },
                }}
                centeredSlides={false}
                spaceBetween={20}
                loop={true}
                freeMode={true}
                modules={[Pagination, Autoplay, FreeMode]}
                className="mySwiper w-full relative py-2 xl:pr-6 lg:pr-3 pr-1"
            >
                {[
                    ...ourEventsData,
                    ...ourEventsData,
                    ...ourEventsData,
                    ...ourEventsData,
                ].map((item) => (
                    <SwiperSlide
                        className="xl:!w-[387px] lg:1w-[360px] w-[313.354px] xl:!h-[309px] lg:!h-[240px] h-[250.198px]"
                        key={item.id}
                    >
                        <SlideBox item={item} />
                    </SwiperSlide>
                ))}
            </Swiper>
        </section>
    );
};

export default EventsSlideBox;
