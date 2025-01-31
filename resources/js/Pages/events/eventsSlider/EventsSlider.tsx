import { Event } from "@/types";
import { useRef } from "react";
import EventsSliderArrowsButtons from "./EventsSliderArrowsButtons";
import EventsSliderBox from "./EventsSliderBox";

export default function EventsSlider({ event }: { event: Event }) {
    const swiperRef = useRef(null);

    return (
        <div className="relative w-full md:w-0 md:h-full md:mr-auto lg:mb-[91px] md:mb-0 mb-40 grow">
            <EventsSliderArrowsButtons
                position={
                    "md:bottom-[6px] bottom-[-115px] md:-right-[75%] md:left-auto left-1/2 -translate-x-1/2"
                }
                swiperRef={swiperRef}
            />
            {/* Swiper Component */}
            <EventsSliderBox swiperRef={swiperRef} images={event.images} />
        </div>
    );
}
