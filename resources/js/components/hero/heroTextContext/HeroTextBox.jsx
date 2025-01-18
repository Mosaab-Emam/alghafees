import MainMessage from "./MainMessage";

import SectionTitle from "../../SectionTitle";
import DownloadApp from "./DownloadApp";

import ContentBox from "./ContentBox";

export default function HeroTextBox() {
    return (
        <section className="text-right flex flex-col justify-center items-start gap-[30px] z-[1] ">
            <SectionTitle />
            <MainMessage />
            <ContentBox className="hidden md:flex " />
            <DownloadApp className="hidden md:flex " />
        </section>
    );
}
