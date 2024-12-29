import React from "react";

import RequestPriceOffer from "../../pages/contactUs/RequestPriceOffer";
import BgGlassFilterShape from "../shapes/BgGlassFilterShape";
import ContactUsShape from "../shapes/ContactUsShape";
import OurClientsShape from "../shapes/OurClientsShape";
import ContactUsContent from "./ContactUsContent";
import ContactUsForm from "./ContactUsForm";

const ContactUsSection = ({
    className,
    position,
    contactUsShapePosition,
    contactUsShapeWidth,
    showPriceOffer,
    contactUsContentPosition,
}) => {
    return (
        <div className={`relative lg:mb-8 mb-[56px] ${className}`}>
            <OurClientsShape position={position} />
            <section className="container">
                <div className="flex md:flex-row flex-col-reverse 2xl:justify-evenly items-center gap-[135px] relative">
                    <ContactUsForm />

                    <BgGlassFilterShape
                        position={"-right-[11rem] -bottom-[8rem]"}
                    />
                    <ContactUsShape
                        svgWidth={contactUsShapeWidth}
                        position={contactUsShapePosition}
                    />
                    {showPriceOffer ? (
                        <div className="w-[493px] flex flex-col items-start gap-8">
                            <ContactUsContent showPriceOffer={showPriceOffer} />
                            <RequestPriceOffer />
                        </div>
                    ) : (
                        <ContactUsContent
                            contactUsContentPosition={contactUsContentPosition}
                        />
                    )}
                </div>
            </section>
        </div>
    );
};

export default ContactUsSection;
