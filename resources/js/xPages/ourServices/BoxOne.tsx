import React from "react";
import { ParagraphContent, TextContent } from "../../xcomponents";

const BoxOne = () => {
    return (
        <section className="md:w-[430px] w-[312px] md:mx-auto flex flex-col justify-center items-center gap-[14px] mb-[50px]">
            <TextContent
                width={"md:w-[405px] w-[312px]"}
                align="md:text-center text-start"
            >
                استفد من{" "}
                <span className="text-primary-600"> خدماتنا العقارية </span>
                المتميزة لدعم قراراتك الذكية
            </TextContent>

            <ParagraphContent>
                نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق
                المملكة.
            </ParagraphContent>
        </section>
    );
};

export default BoxOne;
