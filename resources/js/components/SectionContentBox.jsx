import { Link } from "@inertiajs/react";
import ParagraphContent from "./ParagraphContent";
import SectionTitle from "./SectionTitle";
import TextContent from "./TextContent";
import Button from "./button/Button";

const SectionContentBox = ({
    butWidth,
    navigateTo,
    sectionTitle,
    textContent,
    paragraphContent,
    className = "flex md:flex-row flex-col md:justify-between justify-start md:gap-0 gap-4 md:items-center items-start 2xl:mx-auto lg:mb-[50px] mb-8 w-[312px] lg:w-[1024px] xl:w-[1200px] ",
    sectionTitleTextColor = "text-primary-200",
    textContentWidth,
    textContentTextColor = "text-primary-200",
    paragraphContentTextColor = "text-primary-200",
}) => {
    return (
        <div className={`${className}`}>
            <div className="md:max-w-full max-w-[312px] gap-[14px] flex flex-col flex-shrink-0 items-start">
                <SectionTitle
                    textColor={sectionTitleTextColor}
                    title={sectionTitle}
                />
                <TextContent
                    width={textContentWidth}
                    textColor={textContentTextColor}
                >
                    {textContent}
                </TextContent>

                <ParagraphContent
                    width="md:w-[400px] w-[312px]"
                    textColor={paragraphContentTextColor}
                >
                    {paragraphContent}
                </ParagraphContent>
            </div>
            <div className="">
                <Link href={navigateTo}>
                    <Button className={`py-[15px] ${butWidth}`}>
                        عرض الكل
                    </Button>
                </Link>
            </div>
        </div>
    );
};

export default SectionContentBox;
