import React, { useEffect } from "react";
import { SalehNameEnglishShape } from "../../xcomponents";
import EventDescriptionBox from "./EventDescriptionBox";
import EventInfoCard from "./EventInfoCard";
import EventsSlider from "./eventsSlider/EventsSlider";

const EventsMainContent = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <section className="container md:mt-[211px] mt-[6rem] mb-8 relative">
            <div className="flex md:flex-row flex-col xl:gap-0 lg:gap-6 gap-8 items-center ">
                <EventInfoCard />
                <EventsSlider />
            </div>
            <SalehNameEnglishShape position={"right-[-95px] top-[160px]"} />

            <EventDescriptionBox />
        </section>
    );
};

export default EventsMainContent;
