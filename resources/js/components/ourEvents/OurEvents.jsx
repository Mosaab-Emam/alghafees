import Button from "../button/Button";
import TopSection from "./TopSection";

import EventsSection from "./eventsSection/EventsSection";
import "./OurEvents.css";
const OurEvents = () => {
    return (
        <>
            <TopSection />
            <EventsSection />
            <Button
                onClick={() => (window.location.href = "/events")}
                className={
                    "md:w-[300px] w-full py-[15px] px-[80px] bg-bg-01 text-primary-600 hover:text-bg-01 hover:bg-transparent  border border-bg-01 mx-auto"
                }
            >
                عرض الكل
            </Button>
        </>
    );
};

export default OurEvents;
