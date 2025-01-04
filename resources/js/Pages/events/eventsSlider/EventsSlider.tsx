import { Event } from "@/types";
import { useRef } from "react";
import EventsSliderArrowsButtons from "./EventsSliderArrowsButtons";
import EventsSliderBox from "./EventsSliderBox";

export default function EventsSlider({ event }: { event: Event }) {
    const swiperRef = useRef(null);

    return (
        <div className="relative md:w-[747px] w-full md:mr-auto md:mb-[91px] mb-40">
            <EventsSliderArrowsButtons
                position={
                    "md:bottom-[6px] bottom-[-115px] md:-right-[22.5rem] md:left-auto left-1/2 -translate-x-1/2"
                }
                swiperRef={swiperRef}
            />
            {/* Swiper Component */}
            <EventsSliderBox swiperRef={swiperRef} images={event.images} />
        </div>
    );
}
