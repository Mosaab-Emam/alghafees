import { withColoredText } from "@/utils";

export default function SectionTitle({
    static_content,
    isHeroSection = false,
    title,
    type,
    textColor = "text-primary-600",
}) {
    return (
        <div className="flex items-center justify-start gap-2 ">
            {type === "tow-line_as_image" ? (
                <div className="line_as_image"></div>
            ) : null}
            {isHeroSection ? (
                <p
                    className="text-base font-normal text-Gray-scale-02"
                    dangerouslySetInnerHTML={{
                        __html: withColoredText(
                            static_content.hero_small_top_title
                        ),
                    }}
                />
            ) : (
                <p className={`text-base font-normal ${textColor}`}>{title}</p>
            )}
            <div className="line_as_image"></div>
        </div>
    );
}
