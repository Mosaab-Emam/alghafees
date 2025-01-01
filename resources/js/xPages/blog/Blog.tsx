import React, { useEffect } from "react";
import { Outlet } from "react-router-dom";
import { PageTopSection } from "../../xcomponents";

const Blog = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <Outlet />
        </>
    );
};

export default Blog;
