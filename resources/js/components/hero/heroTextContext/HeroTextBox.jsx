import MainMessage from "./MainMessage";

import SectionTitle from "../../SectionTitle";
import DownloadApp from "./DownloadApp";

import ContentBox from "./ContentBox";

export default function HeroTextBox({ static_content }) {
    return (
        <section className="text-right flex flex-col justify-center items-start gap-[30px] z-[1] ">
            <SectionTitle
                isHeroSection={true}
                static_content={static_content}
            />
            <MainMessage />
            <ContentBox className="hidden md:flex " />
            <DownloadApp className="hidden md:flex " />
        </section>
    );
}
