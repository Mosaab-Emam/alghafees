// Import Swiper React components
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, FreeMode, Navigation, Pagination } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";

import { Bullet } from "../../components";
import SlideBox from "../../components/ourClients/sliderBox/SlideBox";
import { ourClientsData } from "../../data/ourClientsData";

const ClientSliderBox = ({ setIsEnd, setIsBeginning, swiperRef }) => {
    return (
        <section className="our-clients-swiper w-full h-[344px] ">
            <Swiper
                onBeforeInit={(swiper) => {
                    swiperRef.current = swiper;
                }}
                onSlideChange={(swiper) => {
                    setIsEnd(swiper.isEnd);
                    setIsBeginning(swiper.isBeginning);
                }}
                pagination={{
                    clickable: true,
                    el: ".custom-pagination",
                }}
                autoplay={{
                    delay: 200000,
                    disableOnInteraction: false,
                }}
                breakpoints={{
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 16,
                    },

                    768: {
                        slidesPerView: 1.5,
                        spaceBetween: 16,
                    },
                    1024: {
                        slidesPerView: 2.2,
                        spaceBetween: 32,
                    },
                    1200: {
                        slidesPerView: 2.2,
                        spaceBetween: 32,
                    },
                }}
                centeredSlides={false}
                loop={true}
                freeMode={true}
                modules={[Navigation, Pagination, Autoplay, FreeMode]}
                className="mySwiper w-full relative py-2 pr-3 "
            >
                {ourClientsData.map((item) => (
                    <SwiperSlide key={item.id}>
                        <section className="relative 2xl:w-[600px] xl:w-[550px] lg:w-[450px]">
                            <Bullet
                                position="top-[-5px] right-[-7px]"
                                blue={true}
                            />
                            <div className="2xl:w-[600px] xl:w-[550px] lg:w-[450px] glass-effect-bg-primary-2 glass-effect rounded-br-[100px] rounded-tl-[100px] flex flex-col items-start flex-shrink-0 p-8">
                                <SlideBox item={item} />
                            </div>
                            <Bullet position="bottom-[-8px] left-[-6px]" />
                        </section>
                    </SwiperSlide>
                ))}
            </Swiper>
        </section>
    );
};

export default ClientSliderBox;
