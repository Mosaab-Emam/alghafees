import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
// Import Swiper React components
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, FreeMode, Pagination } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";

import { Event } from "@/types";
import { Swiper as SwiperType } from "swiper/types";
import SlideBox from "./SlideBox";

const EventsSlideBox = ({
    events,
    swiperRef,
}: {
    events: Array<Event>;
    swiperRef: React.RefObject<SwiperType>;
}) => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="our-clients-swiper w-full  ">
            {!events.length ? (
                <div className="flex justify-center items-center text-primary-600 text-xl">
                    <div className="line_as_image"></div>
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content["events_empty_text"],
                        }}
                    />
                    <div className="line_as_image"></div>
                </div>
            ) : (
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
                    {events.map((item) => (
                        <SwiperSlide
                            className="xl:!w-[387px] lg:1w-[360px] w-[313.354px] xl:!h-[309px] lg:!h-[240px] h-[250.198px]"
                            key={item.id}
                        >
                            <SlideBox item={item} />
                        </SwiperSlide>
                    ))}
                </Swiper>
            )}
        </section>
    );
};

export default EventsSlideBox;
