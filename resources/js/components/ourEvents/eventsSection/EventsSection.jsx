import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import EventsImages from "./EventsImages";
import EventsVideo from "./EventsVideo";

export default function EventsSection({ events }) {
    const static_content = useContext(staticContext);

    function extractVideoIdFromYoutubeUrl(url) {
        const regex =
            /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regex);
        return match && match[2].length === 11 ? match[2] : null;
    }

    return (
        <section className="flex md:flex-row flex-col-reverse justify-center items-center gap-5 md:mb-[65px] mb-[24px]">
            {events.length && <EventsImages events={events} />}
            <EventsVideo
                videoId={extractVideoIdFromYoutubeUrl(
                    static_content["services_events_video_url"]
                )}
            />
        </section>
    );
}
