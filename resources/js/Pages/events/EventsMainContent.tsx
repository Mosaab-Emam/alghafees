import Container from "@/components/Container";
import { Event } from "@/types";
import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import EventsVideo from "../../components/ourEvents/eventsSection/EventsVideo";
import EventsSlider from "../nestedPages/eventDetailsPage/eventsSlider/EventsSlider";

const EventsMainContent = ({ events }: { events: Array<Event> }) => {
    const static_content = useContext(staticContext) as Record<string, string>;

    function extractVideoIdFromYoutubeUrl(url: string) {
        const regex =
            /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regex);
        return match && match[2].length === 11 ? match[2] : undefined;
    }

    return (
        <section className="md:mt-[211px] mt-[6rem] mb-[85px] relative">
            <Container>
                <div className="relative xl:w-[1200px] lg:w-[1024px] w-full mb-12">
                    <div className="btn btn-primary btn-ltr-radius md:head-line-h4 regular-b1 md:w-[400px] w-max !px-6 md:h-[70px] h-[32px] absolute right-0 top-0 z-[1]">
                        تعرف علينا من نحن و ماذا نقدم ..
                    </div>
                    <EventsVideo
                        hideButton={true}
                        width="w-full"
                        radius="rounded-tl-[50px] rounded-br-[50px]"
                        videoId={extractVideoIdFromYoutubeUrl(
                            static_content["video_url"]
                        )}
                    />
                </div>

                <div className="md:w-[420px] w-[360px] mx-auto md:mb-[50px] mb-8">
                    <h3
                        className=" head-line-h3 text-center text-Black-01"
                        dangerouslySetInnerHTML={{
                            __html: static_content["events_title"],
                        }}
                    />
                </div>

                <EventsSlider events={events} />
            </Container>
        </section>
    );
};

export default EventsMainContent;
