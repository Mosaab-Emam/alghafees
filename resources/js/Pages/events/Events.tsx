import { Event } from "@/types";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import EventsMainContent from "./EventsMainContent";

const Events = ({ events }: { events: Array<Event> }) => (
    <>
        <PageTopSection title={"الفعاليات"} description={"أحدث الفعاليات"} />
        <EventsMainContent events={events} />
    </>
);

Events.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Events;
