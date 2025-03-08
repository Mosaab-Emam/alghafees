import "./Button.css";

const Button = ({
    variant = "primary",
    radius = "",
    className = "",
    onClick = () => {},
    disabled = false,
    children,
    type = "button",
}) => {
    return (
        <button
            type={type}
            onClick={onClick}
            disabled={disabled}
            className={`btn ${
                radius === "right" ? "btn-rtl-radius" : "btn-ltr-radius"
            } ${
                variant === "primary" ? "btn-primary " : "btn-outline"
            } ${className}`}
        >
            {children}
        </button>
    );
};

export default Button;
