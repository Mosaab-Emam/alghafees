import React from "react";
import SectionTitle from "../../SectionTitle";
import HeaderBgImage from "./HeaderBgImage";

const PageHeader = ({ page_title, page_description }) => {
    return (
        <>
            <HeaderBgImage />
            <section className="flex flex-col items-center justify-center mx-auto gap-4 md:mt-[65px] mt-[12px] relative z-[2]">
                <SectionTitle type={"tow-line_as_image"} title={page_title} />
                <h2 className="w-full text-center md:head-line-h4 head-line-h3 text-Black-01">
                    {page_description}
                </h2>
            </section>
        </>
    );
};

export default PageHeader;
