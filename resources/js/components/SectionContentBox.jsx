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
    className = "flex md:flex-row flex-col md:justify-between justify-start md:gap-0 gap-4 md:items-center items-start 2xl:mx-auto lg:mb-[50px] mb-8 w-full xl:w-[1200px] ",
    sectionTitleTextColor = "text-primary-200",
    textContentWidth,
    textContentTextColor = "text-primary-200",
    paragraphContentTextColor = "text-primary-200",
    btnText = "عرض الكل",
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
                    <span dangerouslySetInnerHTML={{ __html: textContent }} />
                </TextContent>

                <ParagraphContent
                    width="md:w-[400px] w-[312px]"
                    textColor={paragraphContentTextColor}
                >
                    <span
                        dangerouslySetInnerHTML={{ __html: paragraphContent }}
                    />
                </ParagraphContent>
            </div>
            <div className="">
                <Link href={navigateTo}>
                    <Button className={`py-[15px] ${butWidth}`}>
                        <span dangerouslySetInnerHTML={{ __html: btnText }} />
                    </Button>
                </Link>
            </div>
        </div>
    );
};

export default SectionContentBox;
