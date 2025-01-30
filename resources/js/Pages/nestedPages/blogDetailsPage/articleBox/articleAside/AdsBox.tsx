import React from "react";
import { AddsImage } from "../../../../../assets/images/blog";

const AdsBox = ({ className }) => {
    return (
        <div className={`${className} lg:h-[310px] h-auto md:self-stretch`}>
            <img className="w-full" src={AddsImage} alt="ads " loading="lazy" />
        </div>
    );
};

export default AdsBox;
