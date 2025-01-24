import { staticContext } from "@/utils/contexts";
import { router } from "@inertiajs/react";
import { useContext } from "react";
import ButtonsBox from "../../ButtonsBox";
import ParagraphContent from "../../ParagraphContent";

const ContentBox = ({ className }) => {
    const static_content = useContext(staticContext);
    return (
        <div
            className={`${className} flex flex-col justify-center items-start gap-[30px]`}
        >
            <ParagraphContent>
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["hero_description"],
                    }}
                />
            </ParagraphContent>

            <ButtonsBox
                gap="gap-4"
                flexDirection="md:justify-center xl:justify-start"
                btnWidth="md:w-[280px] "
                primaryBtnContent={static_content["hero_main_button_text"]}
                primaryButtonOnClick={() =>
                    router.visit(static_content["hero_main_button_link"])
                }
                outlineBtnContent={static_content["hero_secondary_button_text"]}
                outLinButtonOnClick={() =>
                    router.visit(static_content["hero_secondary_button_link"])
                }
            />
        </div>
    );
};

export default ContentBox;
