import React, { useEffect } from "react";
import { Outlet } from "react-router-dom";
import { PageTopSection } from "../../xcomponents";

const OurServices = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
            <Outlet />
        </>
    );
};

export default OurServices;
