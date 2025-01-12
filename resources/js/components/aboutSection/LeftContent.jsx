import React from "react";

// components
import ButtonsBox from "../ButtonsBox";
import AboutGoals from "./AboutGoals";

// icons
import { DownloadIcon } from "../../assets/icons";

// data
import { samplePdf } from "../../assets/pdf-docs";
import { aboutData } from "../../data";

export default function LeftContent({ report }) {
    const handleDownload = () => {
        const link = document.createElement("a");

        link.href = report.file;
        link.download = report.file;
        link.click();
    };

    return (
        <section className="flex flex-col justify-start md:self-end self-start items-start w-full lg:w-[387px] overflow-hidden">
            {aboutData.map((item, index) => (
                <AboutGoals
                    index={index}
                    key={item.id}
                    img={item.img}
                    title={item.title}
                    desc={item.desc}
                />
            ))}

            <ButtonsBox
                radius={"left"}
                btnWidth="w-full lg:w-full xl:w-[387px] "
                gap={"gap-[10px]"}
                flexDirection={"flex-col-reverse"}
                icon={<DownloadIcon />}
                outlineBtnContent={"عرض المزيد من التقارير المعتمدة"}
                primaryBtnContent={report?.title}
                primaryButtonOnClick={handleDownload}
                outLinButtonOnClick={() => (window.location.href = "/about-us")}
                secondaryBtnHref="/about-us"
            />
        </section>
    );
}
