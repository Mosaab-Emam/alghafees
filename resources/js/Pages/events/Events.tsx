import { Event } from "@/types";
import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import EventsMainContent from "./EventsMainContent";

const Events = ({ events }: { events: Array<Event> }) => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <EventsMainContent events={events} />
        </>
    );
};

Events.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Events;
