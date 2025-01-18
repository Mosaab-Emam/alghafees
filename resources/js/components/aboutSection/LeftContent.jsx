import {
    AboutGroup01,
    AboutGroup02,
    AboutGroup03,
} from "@/assets/images/about";
import { staticContext } from "@/utils/contexts";
import { router } from "@inertiajs/react";
import { useContext } from "react";
import { DownloadIcon } from "../../assets/icons";
import ButtonsBox from "../ButtonsBox";
import AboutGoals from "./AboutGoals";

export default function LeftContent({ report }) {
    const static_content = useContext(staticContext);

    const features = [
        {
            id: 1,
            title: static_content["about_feat1_title"],
            img: AboutGroup01,
            desc: static_content["about_feat1_description"],
        },
        {
            id: 2,
            title: static_content["about_feat2_title"],
            img: AboutGroup02,
            desc: static_content["about_feat2_description"],
        },
        {
            id: 3,
            title: static_content["about_feat3_title"],
            img: AboutGroup03,
            desc: static_content["about_feat3_description"],
        },
    ];

    const handleDownload = () => {
        const link = document.createElement("a");

        link.href = report.file;
        link.download = report.file;
        link.click();
    };

    return (
        <section className="flex flex-col justify-start md:self-end self-start items-start w-full lg:w-[387px] overflow-hidden">
            {features.map((item, index) => (
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
                outlineBtnContent={static_content["about_button_text"]}
                primaryBtnContent={report?.title}
                primaryButtonOnClick={handleDownload}
                outLinButtonOnClick={() =>
                    router.visit(static_content["about_button_link"])
                }
                secondaryBtnHref={static_content["about_button_link"]}
            />
        </section>
    );
}
