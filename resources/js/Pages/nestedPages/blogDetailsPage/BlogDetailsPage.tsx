import Layout from "@/Pages/layout/Layout";
import { PageTopSection } from "@/components";
import { Post } from "@/types";
import BlogDetailsTitleBox from "./BlogDetailsTitleBox";
import BlogDetailsTopBox from "./BlogDetailsTopBox";
import ArticleBox from "./articleBox/ArticleBox";
import RelatedTopics from "./relatedTopics/RelatedTopics";

export default function BlogDetailsPage({
    post,
    latest_posts,
    related_posts,
}: {
    post: Post;
    latest_posts: Array<Post>;
    related_posts: Array<Post>;
}) {
    return (
        <Layout>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <section className="container md:mt-[211px] top-[6rem] relative">
                <BlogDetailsTopBox post={post} />
                <BlogDetailsTitleBox post={post} />
                <ArticleBox post={post} latest_posts={latest_posts} />
                <RelatedTopics related_posts={related_posts} />
            </section>
        </Layout>
    );
}
