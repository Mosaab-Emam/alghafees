import React, { useRef } from "react";

import { Event } from "@/types";
import CustomPagination from "../../../../components/ourClients/sliderBox/CustomPagination";
import EventsSlideBox from "./EventsSlideBox";

const EventsSlider = ({ events }: { events: Array<Event> }) => {
    const swiperRef = useRef(null);
    return (
        <div className="relative">
            {/* Swiper Component */}
            <EventsSlideBox swiperRef={swiperRef} events={events} />
            <CustomPagination position="md:!bottom-[-79px] md:!right-auto left-1/2 -translate-x-1/2 !-bottom-10" />
        </div>
    );
};

export default EventsSlider;
