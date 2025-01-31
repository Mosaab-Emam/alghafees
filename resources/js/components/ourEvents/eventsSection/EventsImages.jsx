import { Link } from "@inertiajs/react";
import { useEffect, useState } from "react";
import ShowMoreBtn from "../ShowMoreBtn";

export default function EventsImages({ events }) {
    const [windowWidth, setWindowWidth] = useState(window.innerWidth);

    useEffect(() => {
        const handleResize = () => {
            setWindowWidth(window.innerWidth);
        };

        window.addEventListener("resize", handleResize);
        return () => window.removeEventListener("resize", handleResize);
    }, []);

    const filteredEvents = windowWidth < 640 ? events.slice(0, 1) : events;

    return (
        <div className="flex flex-col md:flex-row lg:flex-col gap-4 self-center w-full md:justify-between lg:justify-normal">
            {filteredEvents.map((item) => (
                <div key={item.id} className="md:w-[50%] lg:w-auto">
                    <div
                        className="lg:w-[200px] xl:w-[285px] w-full lg:h-[200px] xl:h-[249px] relative aspect-square"
                        style={{
                            borderRadius: "50px 0px 0px 50px",
                            background: `linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, #000 100%) , url(${item?.images[0]})  lightgray 50% / cover no-repeat`,
                        }}
                    >
                        <Link href={`/events/${item.id}`}>
                            <ShowMoreBtn position="right-0 top-0" />
                        </Link>
                        <h4 className="md:block hidden lg:pt-[130px] xl:pt-[181px] pb-[24px] pr-[12px] pl-[26px] h-[24px] text-center  text-bg-01  head-line-h5">
                            {item.title}
                        </h4>
                    </div>
                </div>
            ))}
        </div>
    );
}
