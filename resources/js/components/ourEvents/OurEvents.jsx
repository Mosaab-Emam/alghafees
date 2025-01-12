import Button from "../button/Button";
import EventsSection from "./eventsSection/EventsSection";
import "./OurEvents.css";
import TopSection from "./TopSection";

export default function OurEvents({ events }) {
    return (
        <>
            <TopSection />
            <EventsSection events={events} />
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
}
