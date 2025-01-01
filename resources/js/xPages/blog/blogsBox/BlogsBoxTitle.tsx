import React from "react";
import { SectionTitle, TextContent } from "../../../xcomponents";

const BlogsBoxTitle = () => {
    return (
        <section className="md:w-[510px] w-[360px] flex flex-col items-start gap-3 mb-[50px]">
            <SectionTitle title={"التدوينات"} />
            <TextContent
                width={"w-full"}
                align="text-start"
                headLineClass="md:head-line-h2 head-line-h3"
            >
                تابع معنا احدث{" "}
                <span className="text-primary-600"> التدوينات</span> العقارية
            </TextContent>
        </section>
    );
};

export default BlogsBoxTitle;
