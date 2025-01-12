import React, { useState } from "react";
import "swiper/css";
import "swiper/css/thumbs";
import { Thumbs } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";
import { Swiper as SwiperType } from "swiper/types";
import "../../../components/hero/Hero.css";

export default function EventsSliderBox({
    images,
    swiperRef,
}: {
    images: Array<string>;
    swiperRef: React.RefObject<SwiperType>;
}) {
    const [thumbsSwiper, setThumbsSwiper] = useState(null);
    const [visibleCount, setVisibleCount] = useState(4);
    const [activeIndex, setActiveIndex] = useState(0);
    const [startIndex, setStartIndex] = useState(0);

    // Update this function to handle thumbnail window
    const handleSlideChange = (swiper: SwiperType) => {
        setActiveIndex(swiper.activeIndex);

        // Update visible window based on navigation
        if (swiper.activeIndex >= visibleCount - 1) {
            const newStartIndex = swiper.activeIndex - (visibleCount - 2);
            setStartIndex(newStartIndex);
            setVisibleCount(newStartIndex + 4);
        }
    };

    const remainingImages = images.length - visibleCount;

    return (
        <div className="relative flex justify-center items-center w-full">
            {/* Main Slider */}
            <Swiper
                onSwiper={(swiper) => {
                    swiperRef.current = swiper;
                }}
                onSlideChange={handleSlideChange}
                spaceBetween={10}
                thumbs={{ swiper: thumbsSwiper }}
                modules={[Thumbs]}
                className="md:w-[747px] w-full md:h-[597px] h-[285.557px]"
            >
                {images.map((image) => (
                    <SwiperSlide
                        key={image}
                        className="md:w-[747px] w-full md:h-[597px] h-[285.557px flex justify-center items-end md:gap-[10px] gap-[4.783px] md:py-6 py-[11.48px] md:px-[55px] px-[26.308px] md:rounded-br-[100px] md:rounded-tl-[100px] rounded-br-[47.832px] rounded-tl-[47.832px] md:border-[8px] border-[3.827px] border-primary-600 section-box-shadow"
                        style={{
                            background: `url(/${image}) lightgray 50% / cover no-repeat`,
                        }}
                    />
                ))}
            </Swiper>

            {/* Thumbnail Slider */}
            <Swiper
                onSwiper={setThumbsSwiper}
                spaceBetween={10}
                slidesPerView={1}
                watchSlidesProgress={true}
                modules={[Thumbs]}
                className="thumb-slider !absolute -bottom-5 left-1/2 -translate-x-1/2 section-box-shadow"
            >
                {images
                    .slice(startIndex, startIndex + 4)
                    .map((image, index) => (
                        <SwiperSlide
                            key={image}
                            className={`relative cursor-pointer md:!w-[139px] !w-[66.486px] md:!h-[111px] !h-[53.094px] md:border-[4px] border-[1.913px]  ${
                                activeIndex === startIndex + index
                                    ? "border-primary-600"
                                    : "border-bg-01"
                            }`}
                            style={{
                                background: `url(/${image}) lightgray 50% / cover no-repeat`,
                            }}
                        >
                            {/* Show remaining count on last visible thumbnail */}
                            {index === 0 &&
                                remainingImages > 0 &&
                                events.length - (startIndex + 4) !== 0 && (
                                    <div className="absolute inset-0 flex items-center justify-center  !cursor-default">
                                        <span
                                            className="text-white md:head-line-h3 head-line-h5 w-full h-full flex items-center justify-center"
                                            style={{
                                                background: `linear-gradient(0deg, rgba(0, 0, 0, 0.70) 0%, rgba(0, 0, 0, 0.70) 100%),   50% / cover no-repeat`,
                                            }}
                                        >
                                            +{events.length - (startIndex + 4)}
                                        </span>
                                    </div>
                                )}
                        </SwiperSlide>
                    ))}
            </Swiper>
        </div>
    );
}
