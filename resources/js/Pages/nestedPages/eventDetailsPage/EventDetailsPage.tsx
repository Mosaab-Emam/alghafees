import Container from "@/components/Container";
import Layout from "@/Pages/layout/Layout";
import { Event } from "@/types";
import { PageTopSection, SalehNameEnglishShape } from "../../../components";
import EventDescriptionBox from "../../events/EventDescriptionBox";
import EventInfoCard from "../../events/EventInfoCard";
import EventsSlider from "../../events/eventsSlider/EventsSlider";

const EventDetailsPage = ({ event }: { event: Event }) => (
    <>
        <PageTopSection title={"الفعاليات"} description={event.title} />
        <Container>
            <section className="md:mt-[8.5rem] md:py-16 lg:py-0 mt-[6rem] mb-8 relative">
                <div className="flex md:flex-row flex-col xl:gap-0 lg:gap-6 gap-8 items-center md:h-[32rem] lg:h-auto md:mb-16 lg:mb-0">
                    <EventInfoCard event={event} />
                    <EventsSlider event={event} />
                </div>
                <SalehNameEnglishShape position={"right-[-95px] top-[160px]"} />

                <EventDescriptionBox event={event} />
            </section>
        </Container>
    </>
);

EventDetailsPage.layout = (page: React.ReactNode) => <Layout children={page} />;

export default EventDetailsPage;
