import { Event } from "@/types";
import EventsVideo from "../../components/ourEvents/eventsSection/EventsVideo";
import EventsSlider from "../nestedPages/eventDetailsPage/eventsSlider/EventsSlider";

const EventsMainContent = ({ events }: { events: Array<Event> }) => {
    return (
        <section className="container md:mt-[211px] mt-[6rem] mb-[85px] relative">
            <div className="relative xl:w-[1200px] lg:w-[1024px] w-[360px] xl:h-[550px] lg:h-auto h-[206.747px] mb-[50px]">
                <div className="btn btn-primary btn-ltr-radius md:head-line-h4 regular-b1 md:w-[400px] w-max !px-6 md:h-[70px] h-[32px] absolute right-0 top-0 z-[1]">
                    تعرف علينا من نحن و ماذا نقدم ..
                </div>
                <EventsVideo
                    hideButton={true}
                    width="w-full"
                    radius="rounded-tl-[50px] rounded-br-[50px]"
                />
            </div>

            <div className="md:w-[420px] w-[360px] mx-auto md:mb-[50px] mb-8">
                <h3 className=" head-line-h3 text-center text-Black-01">
                    <>
                        كن جزءًا من أحداثنا <br /> وفعالياتنا واستفد من فرص لا
                        تُفوّت
                    </>
                </h3>
            </div>

            <EventsSlider events={events} />
        </section>
    );
};

export default EventsMainContent;
