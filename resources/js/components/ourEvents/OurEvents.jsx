import { staticContext } from "@/utils/contexts";
import { Link } from "@inertiajs/react";
import { useContext } from "react";
import Button from "../button/Button";
import EventsSection from "./eventsSection/EventsSection";
import "./OurEvents.css";
import TopSection from "./TopSection";

export default function OurEvents({ events }) {
    const static_content = useContext(staticContext);

    return (
        <>
            <TopSection />
            <EventsSection events={events} />
            <Link href={static_content["services_events_button_link"]}>
                <Button
                    className={
                        "md:w-[300px] w-full py-[15px] px-[80px] bg-bg-01 text-primary-600 hover:text-bg-01 hover:bg-transparent  border border-bg-01 mx-auto"
                    }
                >
                    <span
                        dangerouslySetInnerHTML={{
                            __html: static_content[
                                "services_events_button_text"
                            ],
                        }}
                    />
                </Button>
            </Link>
        </>
    );
}
