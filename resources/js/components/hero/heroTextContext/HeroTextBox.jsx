import SectionTitle from "../../SectionTitle";
import ContentBox from "./ContentBox";
import DownloadApp from "./DownloadApp";
import MainMessage from "./MainMessage";

export default function HeroTextBox() {
    return (
        <section className="text-right flex flex-col justify-center items-start gap-[30px] z-[1] ">
            <SectionTitle isHeroSection />
            <MainMessage />
            <div className="md:mb-[100%] lg:hidden" />
            <ContentBox className="hidden md:flex " />
            <DownloadApp className="hidden md:flex " />
        </section>
    );
}
