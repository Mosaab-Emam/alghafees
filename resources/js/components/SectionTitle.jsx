import { staticContext } from "@/utils/contexts";
import { useContext } from "react";

export default function SectionTitle({
    isHeroSection = false,
    type,
    textColor = "text-primary-600",
    title = "",
}) {
    const static_content = useContext(staticContext);

    return (
        <div className="flex items-center justify-start gap-2 ">
            {type === "tow-line_as_image" ? (
                <div className="line_as_image"></div>
            ) : null}
            {isHeroSection ? (
                <p
                    className="text-base font-normal text-Gray-scale-02"
                    dangerouslySetInnerHTML={{
                        __html: static_content["hero_small_top_title"],
                    }}
                />
            ) : (
                <p
                    className={`text-base font-normal ${textColor}`}
                    dangerouslySetInnerHTML={{
                        __html: title,
                    }}
                />
            )}
            <div className="line_as_image"></div>
        </div>
    );
}
