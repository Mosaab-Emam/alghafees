import { Event } from "@/types";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import EventsMainContent from "./EventsMainContent";

const Events = ({
    static_content,
    events,
}: {
    static_content: Record<string, string>;
    events: Array<Event>;
}) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <EventsMainContent events={events} />
        </staticContext.Provider>
    );
};

Events.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Events;
