import React, { useRef, useState } from "react";

import ArrowsButtons from "../../../xcomponents/ourClients/sliderBox/ArrowsButtons";
import CustomPagination from "../../../xcomponents/ourClients/sliderBox/CustomPagination";
import ClientSliderBox from "../ClientSliderBox";

const OurClientsSlider = () => {
    const swiperRef = useRef(null);
    const [isEnd, setIsEnd] = useState(false);
    const [isBeginning, setIsBeginning] = useState(true);

    return (
        <div className="relative">
            <ArrowsButtons
                position={
                    "md:bottom-[-79px] bottom-[-160px] md:right-0 right-[8rem]"
                }
                swiperRef={swiperRef}
                isEnd={isEnd}
                isBeginning={isBeginning}
            />
            {/* Swiper Component */}
            <ClientSliderBox
                setIsEnd={setIsEnd}
                setIsBeginning={setIsBeginning}
                swiperRef={swiperRef}
            />

            <CustomPagination position="md:!left-0 !left-1/2 !-translate-x-1/2 md:!bottom-[-75px] !bottom-[-200px]" />
        </div>
    );
};

export default OurClientsSlider;
