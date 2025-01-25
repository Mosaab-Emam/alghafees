import React, { useRef, useState } from "react";

// Import Swiper React components
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, Navigation, Pagination } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";

import Bullet from "../../shapes/Bullet";
import ArrowsButtons from "./ArrowsButtons";
import SlideBox from "./SlideBox";

import { ourClientsData } from "../../../data/ourClientsData";
import BgGlassFilterShape from "../../shapes/BgGlassFilterShape";

const SliderBox = () => {
    const swiperRef = useRef(null);
    const [isEnd, setIsEnd] = useState(false);
    const [isBeginning, setIsBeginning] = useState(true);

    return (
        <div className="relative w-full lg:w-auto">
            <BgGlassFilterShape position="-left-[10rem] -top-[8rem]" />
            {/* Custom Navigation Buttons */}
            <ArrowsButtons
                position={"-top-10 left-0 lg:my-0 my-8"}
                swiperRef={swiperRef}
                isEnd={isEnd}
                isBeginning={isBeginning}
            />

            {/* Swiper Component */}
            <Bullet
                position="lg:-top-[7px] top-[24px] -right-[4px]"
                blue={true}
            />
            <section className="our-clients-swiper  lg:w-[589px] w-full lg:h-[328px] h-auto lg:mt-0 mt-8">
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
                        delay: 3000,
                        disableOnInteraction: false,
                    }}
                    modules={[Navigation, Pagination, Autoplay]}
                    className="mySwiper w-full h-full"
                >
                    {ourClientsData.map((item) => (
                        <SwiperSlide
                            className="glass-effect-bg-primary-2 glass-effect rounded-br-[100px] rounded-tl-[100px] flex flex-col items-start  p-8"
                            key={item.id}
                        >
                            <SlideBox item={item} />
                        </SwiperSlide>
                    ))}
                </Swiper>
            </section>
            <Bullet position="bottom-[29px] -left-[2px]" />

            <div className="custom-pagination flex justify-center mt-8"></div>

            <BgGlassFilterShape position="-right-[10rem] -bottom-[8rem]" />
        </div>
    );
};

export default SliderBox;
