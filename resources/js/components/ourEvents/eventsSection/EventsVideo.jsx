import { useState } from "react";
import PlayVideoBtn from "../PlayVideoBtn";
import ShowMoreBtn from "../ShowMoreBtn";

import { OurEventsVideoCover } from "../../../assets/images/our-events";

import { Link } from "@inertiajs/react";
// Import the ModalVideo component from the react-modal-video library
import ModalVideo from "react-modal-video";
import "react-modal-video/css/modal-video.css";

const EventsVideo = ({
    radius = "rounded-tr-[50px] rounded-br-[50px]",
    width = "lg:w-[795px] xl:w-[895px] w-[360px]",
    videoId = "pUb9EW770d0?si=Cy9a168p4OPvE02N",
    hideButton,
}) => {
    const [isOpen, setIsOpen] = useState(false);
    const openModal = () => {
        setIsOpen(true);
    };

    return (
        <>
            <ModalVideo
                autoplay={1}
                channel="youtube" // or "vimeo" depending on your video source
                isOpen={isOpen}
                videoId={videoId} // Replace with your YouTube/Vimeo video ID
                onClose={() => setIsOpen(false)}
                ratio="16:9"
            />

            <section
                className={`${width} lg:h-[418px] xl:h-[518px] h-[208.358px] flex-shrink-0 relative ${radius} `}
                style={{
                    background: `linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), url(${OurEventsVideoCover})  lightgray 50% / cover no-repeat`,
                }}
            >
                {!hideButton && (
                    <Link href={`/events/${1}`}>
                        <ShowMoreBtn />
                    </Link>
                )}

                <PlayVideoBtn onClick={openModal} />
            </section>
        </>
    );
};

export default EventsVideo;
