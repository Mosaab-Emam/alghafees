import React from "react";
import ServicesImages from "../../xcomponents/ourServices/ServicesImages";
import BoxOne from "./BoxOne";
import OurRealStateServices from "./ourRealStateServices/OurRealStateServices";

const ServicesMainContent = () => {
    return (
        <section className="container md:mt-[211px] mt-[6rem]">
            <BoxOne />
            <ServicesImages />
            <OurRealStateServices />
        </section>
    );
};

export default ServicesMainContent;
