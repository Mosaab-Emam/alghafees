const TextContent = ({
    children,
    headLineClass = "md:head-line-h4 head-line-h3",
    align = "text-right",
    textColor = "text-Black-01",
    width,
}) => {
    return (
        <p
            className={` max-w-full ${headLineClass} ${align} ${width} ${textColor}`}
        >
            {children}
        </p>
    );
};

export default TextContent;
