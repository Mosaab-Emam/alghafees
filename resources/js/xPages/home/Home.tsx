import React from "react";

import {
    AboutSection,
    ContactUsSection,
    Hero,
    OurClients,
    OurPartners,
    OurServices,
} from "../../xcomponents";

function Home() {
    return (
        <>
            <Hero />
            <OurPartners />
            <AboutSection />
            <OurServices />
            <OurClients />
            <ContactUsSection
                position={
                    "lg:-top-[12.3rem] lg:right-0 xl:-top-[7.3rem] xl:-right-[2.5rem] 2xl:-top-[7.3rem] 2xl:right-0 top-[16.3rem] -right-[55px] "
                }
            />
        </>
    );
}

export default Home;
