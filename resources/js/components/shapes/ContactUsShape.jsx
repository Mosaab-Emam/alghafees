import React from "react";
import { ContactUsBgSvg } from "../../assets/images";

const ContactUsShape = ({
    svgWidth = "w-[312px]",
    position = "-top-[126px] left-[5.25rem]",
}) => {
    return (
        <div
            className={`absolute lg:top-[5.6rem] -top-[126px]  z-[-1] ${position}`}
        >
            <ContactUsBgSvg className={`${svgWidth} lg:w-auto`} />
        </div>
    );
};

export default ContactUsShape;
