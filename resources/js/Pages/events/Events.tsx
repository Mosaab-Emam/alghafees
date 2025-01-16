import { Event } from "@/types";
import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import EventsMainContent from "./EventsMainContent";

const Events = ({ events }: { events: Array<Event> }) => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection
                title={"الفعاليات"}
                description={"أحدث الفعاليات"}
            />
            <EventsMainContent events={events} />
        </>
    );
};

Events.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Events;
