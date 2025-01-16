import Layout from "@/Pages/layout/Layout";
import { PageTopSection } from "@/components";
import { Post, Tag } from "@/types";
import BlogDetailsTitleBox from "./BlogDetailsTitleBox";
import BlogDetailsTopBox from "./BlogDetailsTopBox";
import ArticleBox from "./articleBox/ArticleBox";
import RelatedTopics from "./relatedTopics/RelatedTopics";

const BlogDetailsPage = ({
    tags,
    post,
    latest_posts,
    related_posts,
}: {
    tags: Array<Tag>;
    post: Post;
    latest_posts: Array<Post>;
    related_posts: Array<Post>;
}) => {
    return (
        <>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <section className="container md:mt-[211px] top-[6rem] relative">
                <BlogDetailsTopBox post={post} tags={tags} />
                <BlogDetailsTitleBox post={post} />
                <ArticleBox post={post} latest_posts={latest_posts} />
                <RelatedTopics related_posts={related_posts} />
            </section>
        </>
    );
};

BlogDetailsPage.layout = (page: React.ReactNode) => <Layout children={page} />;

export default BlogDetailsPage;
