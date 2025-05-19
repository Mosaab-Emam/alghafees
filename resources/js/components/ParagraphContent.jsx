const ParagraphContent = ({
    children,
    textColor = "text-Gray-scale-02",
    textDirection = "text-right",
    className = "",
}) => {
    return (
        <p className={`regular-b1  ${textColor} ${textDirection} ${className}`}>
            {children}
        </p>
    );
};

export default ParagraphContent;
