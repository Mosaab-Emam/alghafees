import EventsImages from "./EventsImages";
import EventsVideo from "./EventsVideo";

export default function EventsSection({ events }) {
    return (
        <section className="flex md:flex-row flex-col-reverse justify-center items-center gap-5 md:mb-[65px] mb-[24px]">
            {events.length && <EventsImages events={events} />}
            <EventsVideo />
        </section>
    );
}
